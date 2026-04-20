@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-[#588133] focus:ring-[#588133] rounded-md shadow-sm']) !!}>