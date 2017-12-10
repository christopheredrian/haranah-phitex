<form id="fileExport" action="/importExcel" enctype="multipart/form-data" method="POST"
    accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="file" class="col-md-4 col-xs-4 control-label" style=" text-align:right;">{{ 'Excel File' }}</label>
        <div class="col-md-6 col-xs-6">
            <input class="form-control" type="file" name="file" id="file">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-4 col-md-4" style="margin-top: 2%">
            <input class="btn btn-primary" type="submit" value="Import">
        </div>
    </div>
</form>