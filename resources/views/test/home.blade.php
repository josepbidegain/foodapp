<html>
<head>
	<meta charset="UTF-8">
	<title>test vue</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	
	<div id="main">
	VUE APP 1
		<ul>
			<li v-for="item in people">@{{ item }}</li>
		</ul>
		<input type="text" v-model="name" v-on:keyup.enter="addName">
	</div>
	

	<div id="vue2">
		VUE APP 2
		<div class="row">
		<div class="col-sm-4">
			<h3> DATA</h3>
			<ul class="list-group">
				<li v-for="user in lists" class="list-group-item">
					@{{ user.name }} 

				</li>
			</ul>
		</div>
		<div class="col-sm-8">
			<h3>JSON</h3>
			<pre>
				@{{ lists | json }}
			</pre>	
		</div>
		
		</div>	
	</div>
	
	<script src="https://unpkg.com/vue@2.3.3"></script>
 	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.3/vue-resource.min.js"></script> -->
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.1/axios.min.js"></script>
	<script type="text/javascript">
		new Vue({
			el:"#main",			
			data: { 
				people: ["Marcos","Jose", "Ana", "Lucia"]
			},
			name: '',			
			methods:{
				addName:function(){
					this.people.push(this.name);
					this.name = "";
				}				
			}
		});

		//var urlUsers = 'https://randomuser.me/api/?results=5';
		var urlUsers = 'https://jsonplaceholder.typicode.com/users';
		new Vue({
			el:"#vue2",
			created: function(){
					this.getUsers();
			},
			data:{
				lists: [],	
			},			
			methods:{
				getUsers:function(){
					/*this.$http.get(urlUsers).then(function(response){
						this.lists = response.data;	
					});*/
					axios.get(urlUsers).then(response=>{
						this.lists = response.data;
					});
					
				}
			}
			});

	</script>	
</body>
</html>