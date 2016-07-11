
			<div class="col-xs-1 col-sm-2 col-md-3 col-lg-3"></div>
			<div class="container col-xs-10 col-sm-8 col-md-6 col-lg-6" style="background-color: #f7f8f3; margin-top:10px; margin-bottom:10px; margin-right:10px; margin-left:10px;">
				<div class="row">
					<div class="box01">
						<div class="login-window" style="margin-top:10px; margin-bottom:10px; margin-right:10px; margin-left:10px;">
							<div class="page-header" style="background-color: #B4EEB4;">
								<br>
							  <center><h1>Mail It!</h1></center>
								</br>
							</div>
							<?php echo form_open('email'); ?>
								<br>
								<p>Subject:</p>
								<label for="subject" class="sr-only">Subject</label>
								<input type="input" name="subject" class="form-control" placeholder="Type subject here" required autofocus>
								<br>
								<p>Recipient/s: <i>(Please seperate email addresses with comma)</i></p>
								<label for="recipients" class="sr-only">Recipients</label>
								<input type="input" name="recipients" class="form-control" placeholder="Recipients" required autofocus>
								<br>
								<p>Message:</p>
								<label for="message" class="sr-only">Message</label>
								<textarea name="message" class="form-control" placeholder="Type your mesage here" required autofocus rows="4" cols="50"></textarea>
								<br>
								<div style="text-align:center;">
									<button class="btn btn-primary" value="send" name="email" type="submit" style="text-align:center;">Send</button>
								</div>
				
							</form>
							
						</div>

					</div>
				</div>
			</div>
			<div class="col-xs-1 col-sm-2 col-md-3 col-lg-3"></div>
			 
			