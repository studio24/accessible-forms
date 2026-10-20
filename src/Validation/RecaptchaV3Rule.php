<?php
declare(strict_types=1);

namespace Studio24\AccessibleForms\Validation;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Lunaweb\RecaptchaV3\RecaptchaV3;
use Throwable;

/**
 * Laravel validation rule to verify a reCAPTCHA v3 token
 *
 * Requires josiasmontag/laravel-recaptchav3
 */
class RecaptchaV3Rule implements ValidationRule
{
    /**
     * Run even when the token is empty, so a missing token fails validation
     * (laravel-form-bridge adds "nullable" to non-required fields)
     */
    public bool $implicit = true;

    public function __construct(
        protected string $action,
        protected float $score,
        protected string $message,
    ) {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value) || $value === '') {
            $fail($this->message);
            return;
        }

        try {
            $score = app(RecaptchaV3::class)->verify($value, $this->action);
        } catch (Throwable $e) {
            report($e);
            $score = false;
        }

        if ($score === false || $score < $this->score) {
            $fail($this->message);
        }
    }

    /**
     * laravel-form-bridge's RulesParser treats every rule as a string when building the view
     */
    public function __toString(): string
    {
        return 'recaptcha_v3';
    }
}
