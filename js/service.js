var api = {
	post : function(route, data, callback){
		app.loading = true;
		$.post('api/?request=' + route, data, function(data){
			app.loading = false;
			callback(data);
		})
	},
	get : function(route, callback){
		app.loading = true;
		$.get('api/?request=' + route, function(data){
			app.loading = false;
			callback(data);
		})
	}
}