<?php

Blade::extend(function ($value) {
    $pattern = Blade::createPlainMatcher('continue');
    return preg_replace($pattern, '$1<?php continue; ?>$2', $value);
});

Blade::extend(function ($value) {
    $pattern = Blade::createPlainMatcher('break');
    return preg_replace($pattern, '$1<?php break; ?>$2', $value);
});
