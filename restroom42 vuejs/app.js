Vue.config.devtools = true;
Vue.config.productionTip = false;
Vue.config.production = false;
Vue.config.performance = true;
Vue.config.silent = false;

function mydump(arr,level) {
    var dumped_text = "";
    if(!level) level = 0;

    var level_padding = "";
    for(var j=0;j<level+1;j++) level_padding += "    ";

    if(typeof(arr) == 'object') {  
        for(var item in arr) {
            var value = arr[item];

            if(typeof(value) == 'object') { 
                dumped_text += level_padding + "'" + item + "' ...\n";
                dumped_text += mydump(value,level+1);
            } else {
                dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
            }
        }
    } else { 
        dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
    }
    return dumped_text;
}
Vue.config.warnHandler = function (msg, vm, trace) { 
  // `trace` est la trace de la hiérarchie des composants 
  console.dir(msg);
  console.dir(vm);
 //   console.log(mydump(vm,2268));
 // console.log(JSON.stringify(vm));

}


/*
Vue.config.errorHandler = function (err, vm, info) {
    // handle error
    // `info` is a Vue-specific error info, e.g. which lifecycle hook
    // the error was found in. Only available in 2.2.0+
    console.log('Custom vue error handler: ', err, vm.name, info);
};

Vue.config.errorHandler = function (err, vm, info)  {
  let handler, current = vm
  console.log(vm.$options)
  console.log(vm.$options.errorHandler)
  if (vm.$options.errorHandler) {
  	handler = vm.$options.errorHandler
  } else {
  	while (current.$parent) {
    	current = current.$parent
    	if (handler = current.$options.errorHandler) break
    }
  }
  if (handler) handler.call(current, err, vm, info)
  else console.log(err)
};

Vue.config.warnHandler = function (err, vm, info) {
    // handle error
    // `info` is a Vue-specific error info, e.g. which lifecycle hook
    // the error was found in. Only available in 2.2.0+
    console.log('Custom vue warn handler: ', err, vm.name, info);
};

window.onerror = function (message, source, lineno, colno, error) {
  /// what you want to do with error here
  console.log('Custom vue window.onerror handler: ', message, source, lineno, colno, error);
};*/
var app = new Vue({
	el: '#members',
	data:{

		members: [],
		listeEtage: [],
		EtageData: [],
		WaitVotant: [],
		CountEtageparvotant: []


	},


	mounted: function(){
		this.getAllMembers();
	},

	methods:{
		getAllMembers: function(){
			axios.get("api.php")
				.then(function(response){
			/*		console.log(response);*/
					app.listeEtage = ['E3', 'E2', 'E1', 'E0'];
					app.EtageData = response.data.EtageData;
					for(var i = 0; i < app.listeEtage.length; i++) 
					{

						if(typeof app.EtageData[app.listeEtage[i]] == 'undefined')
						{
							app.EtageData[app.listeEtage[i]] = "0";
						} 
					}
					app.WaitVotant = response.data.WaitVotant;


					app.CountEtageparvotant = response.data.CountEtageparvotant;
					console.log(app.CountEtageparvotant);
					if(app.CountEtageparvotant.length == 0)
					{
									console.log("undifined app.CountEtageparvotant[app.listeEtage[0]][1]");
						app.CountEtageparvotant = new Array([app.listeEtage]);
						for(var i = 0; i < app.listeEtage.length; i++) 
						{
						app.CountEtageparvotant[app.listeEtage[i]] = new Array([1]);
						}
						console.log(app.CountEtageparvotant);
					}
					else {
					for(var i = 0; i < app.listeEtage.length; i++) 
						{
							console.log(app.listeEtage[i]);
							if(!app.CountEtageparvotant[app.listeEtage[i]] )
							{
								app.CountEtageparvotant[app.listeEtage[i]] = new Array([1]);
							} 
						if(typeof app.CountEtageparvotant[app.listeEtage[i]][1] == 'undefined')
							{
								app.CountEtageparvotant[app.listeEtage[i]][1] = "00:00:00";
							} 
						}
				    }

					app.members = response.data.members;

									console.log(app.listeEtage);							
									console.log(app);

				});
		}
	}
});
Vue.filter('removeNullProps',function(object) {
  // sorry for using lodash and ES2015 arrow functions :-P
  return _.reject(object, (value) => value === null)
});