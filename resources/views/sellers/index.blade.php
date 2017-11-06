@extends('layouts.app-seller')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <img src="http://www.researchassociatesinc.com/RAI/media/RAIMedia/bizinvestigations.jpg" style="width: 100%; max-height: 200px">
            <div class="panel-heading">Event Name</div>
            <div class="container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <p> Description of Event</p>
                            <p> Event Place</p>
                            <p> Date of Event</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">List of Interested Buyers</div>
            <div class="container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <table>
                                <thead></thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection