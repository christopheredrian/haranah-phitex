@extends('layouts.app-buyer')

@section('content')
    <img src="http://www.researchassociatesinc.com/RAI/media/RAIMedia/bizinvestigations.jpg" style="width: 100%; max-height: 250px; padding-bottom: 10px">

    <div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">Event Name</div>
            <div class="box-body">
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
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">List of interested buyers</h3>

                <div class="box-tools pull-right">
                    <div class="has-feedback">
                        <input type="text" class="form-control input-sm" placeholder="Search">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </div>
                <!-- /.box-tools -->
            </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                            </div>
                            <!-- /.btn-group -->
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                            <div class="pull-right">
                                1-50/200
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                </div>
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.pull-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                    <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                    <td class="mailbox-subject"><b>Email</b>
                                    </td>
                                    <td class="mailbox-attachment"></td>
                                    <td class="mailbox-date">5 mins ago</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                                    <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                    <td class="mailbox-subject"><b>Email</b>
                                    </td>
                                    <td class="mailbox-attachment">
                                    <td class="mailbox-date">1 hour ago</td>

                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                                    <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                    <td class="mailbox-subject"><b>Email</b>
                                    </td>
                                    <td class="mailbox-attachment">
                                    <td class="mailbox-date">11 hours ago</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                    <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                    <td class="mailbox-subject"><b>Email</b>
                                    </td>
                                    <td class="mailbox-attachment"></td>
                                    <td class="mailbox-date">15 hours ago</td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
                <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                    </div>
                    <!-- /.btn-group -->
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">
                        1-50/200
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <!-- /.pull-right -->
                </div>
            </div>
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>
    </div>
@endsection