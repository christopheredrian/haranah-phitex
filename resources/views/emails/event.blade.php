@extends('layouts.app-admin')

@section('styles')
    <style>
        .col-xs-12.has-feedback.input-group {
            padding-left: 10px;
            padding-right: 10px;
        }

        .col-md-6.col-xs-12.has-feedback.input-group button {
            margin-right: 0;
        }
    </style>
@endsection
@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h1>{{ $title }}</h1>
        </div>
        <form action="/admin/event/{{ $event_id }}/sendmail" method="post"
              class="form-horizontal form-label-left input_mask">
            {{ csrf_field() }}
            <input type="hidden" name="event_id" value="{{ $event_id }}">

            <div class="col-xs-12 has-feedback input-group">
                <input class="form-control has-feedback-right" id="to" type="email" name="to" placeholder="{{ $to }}"
                       readonly="readonly">
                {{--<button type="button" class="btn btn-primary btn-xs form-control-feedback right">Show</button>--}}
                <span class="input-group-btn">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target=".bs-example-modal-lg">Show All</button>
                </span>
                {{--<span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>--}}
            </div>
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true"
                 style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel"> {{ $to }}</h4>
                        </div>
                        <div class="modal-body">
                            <ul>
                                @foreach($addresses as $address)
                                    <li>{{ $address }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class=" col-xs-12 form-group has-feedback">
                <input class="form-control has-feedback-left" id="address" type="email" name="address"
                       placeholder="Email From">
                <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-xs-12 form-group has-feedback">
                <input class="form-control has-feedback-left" id="subject" type="text" name="subject"
                       placeholder="Subject">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-xs-12 form-group has-feedback">
                <input class="form-control has-feedback-left" id="name" type="text" name="name"
                       placeholder="Name of Sender">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            </div>
            {{--<textarea id="" cols="90" rows="10" name="body" placeholder="content"></textarea>--}}

            <div id="alerts"></div>
            <div class="clearfix"></div>
            <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i
                                class="fa fa-font"></i><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    </ul>
                </div>

                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i
                                class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a data-edit="fontSize 5">
                                <p style="font-size:17px">Huge</p>
                            </a>
                        </li>
                        <li>
                            <a data-edit="fontSize 3">
                                <p style="font-size:14px">Normal</p>
                            </a>
                        </li>
                        <li>
                            <a data-edit="fontSize 1">
                                <p style="font-size:11px">Small</p>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                    <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i
                                class="fa fa-italic"></i></a>
                    <a class="btn" data-edit="strikethrough" title="Strikethrough"><i
                                class="fa fa-strikethrough"></i></a>
                    <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i
                                class="fa fa-underline"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i
                                class="fa fa-list-ul"></i></a>
                    <a class="btn" data-edit="insertorderedlist" title="Number list"><i
                                class="fa fa-list-ol"></i></a>
                    <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i
                                class="fa fa-dedent"></i></a>
                    <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i
                                class="fa fa-align-left"></i></a>
                    <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i
                                class="fa fa-align-center"></i></a>
                    <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i
                                class="fa fa-align-right"></i></a>
                    <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i
                                class="fa fa-align-justify"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i
                                class="fa fa-link"></i></a>
                    <div class="dropdown-menu input-append">
                        <input class="span2" placeholder="URL" type="text" data-edit="createLink">
                        <button class="btn" type="button">Add</button>
                    </div>
                    <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn" title="Insert picture (or just drag &amp; drop)" id="pictureBtn"><i
                                class="fa fa-picture-o"></i></a>
                    <input type="file" data-role="magic-overlay" data-target="#pictureBtn"
                           data-edit="insertImage">
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                    <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i
                                class="fa fa-repeat"></i></a>
                </div>
            </div>
            <div id="editor-one" class="editor-wrapper placeholderText" contenteditable="true"><br></div>
            <input type="hidden" name="body" id="hidden-editor">
            {{--<textarea name="body" style="display:none;"></textarea>--}}

            <br>

            <div class="ln_solid"></div>


            <button type="submit" class="btn btn-success pull-right">Submit</button>

        </form>
    </div>

@endsection

@section('scripts')
    {{-- For the editor --}}
    <script src="/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js" type="text/javascript"></script>
    <script src="/vendors/jquery.hotkeys/jquery.hotkeys.js" type="text/javascript"></script>
    <script src="/vendors/google-code-prettify/src/prettify.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#editor-one').wysiwyg();
            $('#editor-one').change(function () {
                $('#hidden-editor').val($('#editor-one').html());
            });
        });
    </script>
@endsection