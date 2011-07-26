module("Model: Spools.Models.Token")

test("findAll", function(){
	stop(2000);
	Spools.Models.Token.findAll({}, function(tokens){
		start()
		ok(tokens)
        ok(tokens.length)
        ok(tokens[0].name)
        ok(tokens[0].description)
	});
	
})

test("create", function(){
	stop(2000);
	new Spools.Models.Token({name: "dry cleaning", description: "take to street corner"}).save(function(token){
		start();
		ok(token);
        ok(token.id);
        equals(token.name,"dry cleaning")
        token.destroy()
	})
})
test("update" , function(){
	stop();
	new Spools.Models.Token({name: "cook dinner", description: "chicken"}).
            save(function(token){
            	equals(token.description,"chicken");
        		token.update({description: "steak"},function(token){
        			start()
        			equals(token.description,"steak");
        			token.destroy();
        		})
            })

});
test("destroy", function(){
	stop(2000);
	new Spools.Models.Token({name: "mow grass", description: "use riding mower"}).
            destroy(function(token){
            	start();
            	ok( true ,"Destroy called" )
            })
})