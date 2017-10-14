<form action="/emails/sendmail" method="post">
    {{ csrf_field() }}
    <input type="text" name="subject" placeholder="Subject">
    <input type="text" name="to" placeholder="to">
    <input type="text" name="from" placeholder="from">
    <textarea id="" cols="30" rows="10" name="content" placeholder="content">

    </textarea>
    <input type="submit">
</form>