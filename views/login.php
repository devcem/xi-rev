<div id="wrapper" class="row">
	<div class="col-md-4 col-centered">
		<div class="text-center big-icon">
			<h1><i class="fa fa-cube" aria-hidden="true"></i></h1>
			<p>Sign in to Tribal's Animation Dashboard</p>
		</div>
		<form v-on:submit.prevent="login()" class="panel panel-default form-horizontal">
			<div class="panel-heading">
				Login
			</div>
			<div v-show="message.text" class="alert alert-info" :class="{'alert-danger' : message.error}">
				{{message.text}}
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-4 control-label">Username :</label>
					<div class="col-sm-8">
						<input type="text" v-model="form.username" class="form-control" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Password :</label>
					<div class="col-sm-8">
						<input type="password" v-model="form.password" class="form-control" placeholder="Password">
					</div>
				</div>
			</div>
			<div class="panel-footer text-right">
				<label class="pull-left">
					<input type="checkbox" v-model="form.remember">
					Remember me
				</label>
				<button class="btn btn-primary" :disabled="loading">Login</button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	var app = new Vue({
		el : '#wrapper',
		data : {
			form : {
				username : '',
				password : '',
				remember : false
			},
			loading : false,
			message : {}
		},
		methods : {
			init  : function(){
				api.get('cookie.global', function(response){
					app.form.username = response.data.cookie_global_username;
					app.form.password = response.data.cookie_global_password;
					app.form.remember = response.data.cookie_global_remember;
				});
			},
			login : function(){
				api.post('account.login', app.form, function(response){
					app.message = response.message;
					
					if(!response.message.error){
						window.location = '.';
					}

					setTimeout(function(){
						app.message = {};
					}, 2000);
				});
			}
		}
	});
</script>