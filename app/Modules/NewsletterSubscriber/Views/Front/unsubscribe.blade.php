
<style>
body {
	background-color: #C7C7C7;
  margin: 0;
}

td, 
.groups p {
  font-size: 13px;
  color: #878787;
}

.unsubscribed-page h1, 
.unsubscribed-page h2 {
  color: black;
}

.unsubscribed-page h1 {
  font-size: 25px;
}

.unsubscribed-page h2 {
  font-size: 20px;
}

.unsubscribed-page a {
  color: #2F82DE;
  font-weight: bold;
  text-decoration: none;
}

.unsubscribed-page {
  background: #C7C7C7;
  width: 100%;
  padding: 20px 0;
  font-family: 'Nunito', sans-serif;
  line-height: 1.5;
}

.email-body {
  max-width: 600px;
  min-width: 320px;
  margin: 0 auto;
  background: white;
  border-collapse: collapse;
}
.email-body img {
  max-width: 100%;
}

.email-header {
  background: #34ade38f;
  padding: 30px;
}

.news-section {
  padding: 20px 30px;
}


.groups ul {
  margin: 0 0 10px 25px;
  padding: 0;
  display: block;
  padding: 0;
  margin: 0;
  list-style: none;
}
.groups li {
  margin: 0 0 3px 0;
}

.required {
  display: none;
  width: 100%;
  height: 150px;
  color: #5d5d5d;
  text-align: left;
  font-size: 12px;
  overflow: auto;
}
.formEmailButton {
  color: #fff;
  background-color: #34ade3;
  padding: 10px 20px;
  margin: 10px 0;
  outline: none;
  border: 1px solid #34ade3;
  border-radius: 7px;
}

.footer {
  background: #eee;
  padding: 10px;
  font-size: 10px;
  text-align: center;
}
</style>
<table class="unsubscribed-page">
      <tr>
        <td>
          <table class="email-body">
            <tr>
              <td class="email-header" align="center">
                <a href='{{ route("home.index") }}'>
                  <h1>LOGO</h1>
<!--                   <img src="" alt="" width="" height="98" /> -->
                </a>
              </td>
            </tr>

            <tr>
              <td class="news-section">
                <div id="templateBody" class="bodyContent rounded6">
                  <h2> Unsubscribe Successfully!! </h2>
                  <div>You will no longer receive email marketing from this list.
                  </div>
                  <!-- <form id="unsubscribe-reason-form" method="POST" style="">
                    <input type="hidden" name="u" value="94df596a350418d6a86a17f95">
                    <input type="hidden" name="id" value="d162cfcfa6">
                    <input type="hidden" name="e" value="2acd430bd1">
                  	<div class="groups">
                      <div id="unsub-reason-success" style="display:none;" class="alert">
                        Thanks for the feedback!
                      </div>
                      <div id="unsub-reason-error" class="error" style="display:none;">
                        There were errors recording your feedback, please try again later
                      </div>
                  		<h3 class="unsub-title">If you have a moment, please let us know why you unsubscribed:</h3>
                  		<ul class="unsub-options">
                  			<li>
                          <label class="radio" for="r1">
                            <input type="radio" name="unsub-reason" value="NORMAL" id="r1" onclick="notextarea()">
                            <span>I no longer want to receive these emails</span>
                          </label>
                        </li>
                  			<li>
                          <label class="radio" for="r2">
                            <input type="radio" name="unsub-reason" value="NOSIGNUP" id="r2" onclick="notextarea()">
                            <span>I never signed up for this mailing list</span>
                          </label>
                        </li>
                  			<li>
                          <label class="radio" for="r3">
                            <input type="radio" name="unsub-reason" value="INAPPROPRIATE" id="r3" onclick="notextarea()">
                            <span>The emails are inappropriate</span>
                          </label>
                        </li>
                  			<li>
                          <label class="radio" for="r4">
                            <input type="radio" name="unsub-reason" value="SPAM" id="r4" onclick="notextarea()">
                            <span>The emails are spam and should be reported</span>
                          </label>
                        </li>
                  			<li>
                          <label class="radio" for="r5">
                            <input type="radio" name="unsub-reason" value="OTHER" id="r5" onclick="showtextarea()">
                            <span>Other (fill in reason below)</span>
                          </label>
                          <br>
                  				<textarea id="unsub-reason-desc" name="unsub-reason-desc" style="" row="2" cols="20" class="required"></textarea>
                  			</li>
                  			<li>
                          <input class="formEmailButton" type="submit" name="submit" value="Submit">
                        </li>
                  		</ul>
                  	</div>
                  </form> -->
                  <br>
                  <a href='{{ route("home.index") }}'>« Return to our website</a>
                </div>
              </td>
            </tr>

            <tr>
              <td class="footer">
                You're receiving this email because you subscribed this newsletter. You can <a href="#">Unsubscribe</a> any time.
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>