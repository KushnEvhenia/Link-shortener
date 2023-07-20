@php $editing = isset($link) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="link"
            label="Link"
            :value="old('link', ($editing ? $link->link : ''))"
            maxlength="255"
            placeholder="Link"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="link_id"
            label="Link Id"
            :value="old('link_id', ($editing ? $link->link_id : ''))"
            maxlength="255"
            placeholder="Link Id"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
