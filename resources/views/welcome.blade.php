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
        overflow-y: hidden;
    }
    div {
        overflow-y: hidden;
    }
    p {
        font-family: "Verdana", Geneva, sans-serif;
    }
</style>
{{--images are not owned by the developers, all credit belongs to the rightful owner--}}
<div class="container" align="center" style="overflow: hidden">
    <div class="row">
        <div class="col-md-12">
            <img class="img-responsive" src="/img/banner.jpg" alt="Banner" style="width: 100%; height: 75%">
            <div class="caption">
                <h1>WELCOME TO PHITEX</h1>
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">About</button>
                <a class="btn btn-primary btn-lg" href="/login">Login</a>
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
                <img src="/img/seller.png" alt="Seller" class="img-thumbnail" style="width:300px; height: 300px;">
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="img">
                <img src="/img/events.png" alt="Events"  class="img-thumbnail" style="width:300px; height: 300px;">
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">About PHITEX</h4>
            </div>
            <div class="modal-body" style="">
                <p>Philippine Travel Exchange (PHITEX) is a marketing activity conceived in 1996 with the end-goal of increasing tourist arrivals in the country.</p>

                <p>Patterned after ASEAN Tourism Forum (ATF), this event hosts qualified buyers all over the world to participate in a one and half days table top business appointments with Philippine sellers and have actual experience of what the country can offer as a tourism destination through pre/post tours.</p>

                <p>After 5 years’ hibernation, PHITEX made a successful comeback in 2004 and since then became a major annual marketing event that further strengthens the country’s brand image and encourages participants to promote affordable and competitive tourism packages.</p>
                <p>In 2007, aside from holding it in Cebu for the first time, another component was added in staging of PHITEX, the Educational Seminar. This is a learning activity wherein in industry experts were invited as resource speakers to discuss new trends in tourism marketing as well as marketing strategies in mature and emerging markets.</p>

                <p>In 2015, PHITEX was combined with MICECON, another major marketing activity headed by TPB that aims to consolidate and strengthen various sector involved in M.I.C.E (meeting, Incentive Travel, Conventions and Exhibitions/Events) industry.</p>

                <p>2017 will bring another important and exciting changes to PHITEX:</p>
                <ul>
                    <li>TRAVEX will be held before the Philippine Travel Mart</li>
                    <li>TRAVEX will be staged for one and half days, yielding a total of 40 pre-arranged business sessions</li>
                    <li>No more pre-tours but Metro Manila half day tours will be offered on the afternoon of 31 August</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>