@extends('layouts.app')

@section('content')
<section class="form">
    <h2 align="center">Создание заказа</h2>
    <form method="post" action="{{route('createOrder')}}">
    @csrf
        <input class="form-control-lg" type="text" placeholder="ФИО" name="name">
        <input class="form-control-lg" type="text" placeholder="Артикул товара" name="article">
        <input class="form-control-lg" type="text" placeholder="Бренд товара" name="manufacturer">
        <textarea class="form-control-lg" type="text" placeholder="Комментарий" name="comment"></textarea>
        <button class="btn btn-secondary btn-lg">Создать</button>
    </form>

</section>
@endsection
