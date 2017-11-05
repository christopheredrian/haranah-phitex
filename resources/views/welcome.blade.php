@extends('layouts.public')
<style>
    .caption {
        background-color: rgba(0, 0, 0, 0);
        bottom: 0px;
        color: white;
        font-size: 1.2em;
        left: 0px;
        padding: 10px 15px;
        position: absolute;
        transition: 0.5s padding;
        text-align: center;
        width: 100%;
        top: 45%;

    }
    </style>
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
    <div class="row">
        <div class="col-md-4">
            <div class="img">
                    <img src="/img/buyer.png" alt="Buyer" style="width:300px; height: 300px;">
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="img">
                <img src="/img/buyer.png" alt="Buyer" style="width:300px; height: 300px;">
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="img">
                <img src="/img/buyer.png" alt="Buyer" style="width:300px; height: 300px;">
                </a>
            </div>
        </div>
    </div>


