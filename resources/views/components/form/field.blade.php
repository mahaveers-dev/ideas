@props(['name', 'label', 'type' => 'text'])

<div class="space-y-2">
    <label for="{{$name}}" class="label">{{$label}}</label>
    @if($type === 'textarea')
        <textarea name="{{$name}}" id="{{$name}}" class="textarea" {{ $attributes }}></textarea>
    @else
        <input type="{{$type}}" class="input" id="{{$name}}" name="{{$name}}" value="{{old($name, '')}}" {{ $attributes }}>
    @endif
    <x-form.error name="{{ $name }}"/>
</div>