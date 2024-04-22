<x-mail::message>
# Замовлення успішно прийнято!

**Послуга:** {{$data['service']}}<br>
**Тривалість:** {{$data['duration']}}хв<br>
**Майстер:** {{$data['master']}}<br>
**Дата та час:** {{$data['datetime']}}<br>
@if(isset($data['discount']))
**Знижка:** -{{$data['discount']}}%
@endif

---

До оплати: **{{$data['cost']}} грн**

## Дякуємо, що обрали саме нас!
</x-mail::message>



