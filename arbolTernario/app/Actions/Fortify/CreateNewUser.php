<?php
namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\ValidationException;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'patrocinador_id' => ['required', 'exists:users,id'],
        ])->validate();

		return DB::transaction(function () use ($input) {
            $sponsor = User::find($input['patrocinador_id']);

            // Check if the sponsor has reached the maximum number of referrals at their current level
            if ($this->hasReferralLimitReached($sponsor, $sponsor->level+1)) {
                throw ValidationException::withMessages([
                    'patrocinador_id' => ['The sponsor has reached the referral limit at this level.'],
                ]);
            }

            $level = $sponsor->level + 1;

            // Create the new user
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'patrocinador_id' => $input['patrocinador_id'],
                'level' => $level,
            ]);

            return $user;
        });
    }

    private function hasReferralLimitReached($user, $level)
    {
        // Count the number of referrals at the same level as the sponsor
        $referralCount = $user->referidos->where('level', $level)->count();

        // Check if the sponsor has reached the maximum of 3 referrals at this level
        return $referralCount >= 3;
    }
}