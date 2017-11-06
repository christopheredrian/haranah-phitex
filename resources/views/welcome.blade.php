@extends('layouts.public')
<style>
    .caption {
        background-color: rgba(0, 0, 0, 0);
        color: orange;
        font-size: 1.2em;
        left: 0px;
        padding: 10px 15px;
        position: absolute;
        transition: 0.5s padding;
        text-align: center;
        width: 100%;
        top: 45%;
        opacity: 0.9;
    }
    </style>
{{--images are not owned by the developers, all credit belongs to the rightful owner--}}
<div class="container" align="center">
    <div class="row">
        <div class="col-md-12">
            <img class="img-responsive" src="/img/banner.jpg" alt="Banner" style="width: 100%; height: 75%">
            <div class="caption">
                <h1>WELCOME TO PHITEX</h1>
                <a class="btn btn-primary" href="/login">Login</a>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="img">
                    <img src="/img/buyer.png" alt="Buyer" class="img-thumbnail" style="width:300px; height: 300px;">
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="img">
                <img src="/img/buyer.png" alt="Buyer" class="img-thumbnail" style="width:300px; height: 300px;">
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="img">
                <img src="/img/buyer.png" alt="Buyer"  class="img-thumbnail" style="width:300px; height: 300px;">
                </a>
            </div>
        </div>
    </div>


