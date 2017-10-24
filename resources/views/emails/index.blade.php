<h1>Email Demonstration</h1>
<hr>
<form action="/emails/sendmail" method="post">
    {{ csrf_field() }}
    <div>
        <label for="to">To</label>
        <input id="to" type="email" name="to" placeholder="to@example.com">
    </div>
    <div>
        <label for="address">From</label>
        <input id="address" type="email" name="address" placeholder="noreply@gmail.com">
    </div>
    <div>
        <label for="subject">Subject</label>
        <input id="subject" type="text" name="subject" placeholder="Request for...">
    </div>
    <div>
        <label for="name">Name of Sender</label>
        <input id="name" type="text" name="name" placeholder="John Doe">
    </div>
    <textarea id="" cols="90" rows="10" name="body" placeholder="content"></textarea><br>
    <input type="submit">
</form>