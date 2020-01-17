@extends('Main.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <div class="row">
                    <div class="col-lg-9">
                        <h2>Mensajes ({{ $new }})</h2>
                    </div>
                    <div class="col-lg-3">
                        <a class="btn btn-block btn-primary compose-mail" href="{{ url('mailbox/compose') }}">Nuevo mail</a>
                    </div>
                </div>
            </div>
            <div class="mail-box">
                <table class="table table-hover table-mail">
                    <tbody>
                        @foreach($mails as $mail)
                            <tr class="@if($mail->read) read @else unread @endIf">
                                <td class="mail-contact"><a href="{{ url('mailbox/view/' . $mail->id )}}">Usuario</a></td>
                                <td class="mail-subject"><a href="{{ url('mailbox/view/' . $mail->id )}}">Asunto</a></td>
                                <td class="text-right mail-date">{{ $mail->created_at }}</td>
                            </tr>
                        @endForeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endSection