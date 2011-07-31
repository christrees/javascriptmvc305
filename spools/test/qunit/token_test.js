module("Model: Spools.Models.Token")

test("findAll", function(){
	stop(2000);
	Spools.Models.Token.findAll({}, function(tokens){
		start()
		ok(tokens)
        ok(tokens.length, "got lenght")
        ok(tokens[0].state, "state")
        ok(tokens[0].idCreator, "idCreator")
        ok(tokens[0].idOwner, "idOwner")
        ok(tokens[0].idPlayer, "idPlayer")
        ok(tokens[0].idGameBrd,"idGameBrd")
        ok(tokens[0].idGamePos, "idGamePos")
        ok(tokens[0].id, "id")
       // ok(tokens[0].XXXX, "crap test")
	}, "Test Token data types");
	
})

test("create", function(){
	stop(2000);
	new Spools.Models.Token({
            state: "play",
            idCreator: "Christ", 
            idOwner: "game", 
            idPlayer: "game", 
            idGameBrd: "1", 
            idGamePos: "1", 
            id: 1
        }).save(function(token){
		start();
		ok(token);
        ok(token.id);
        equals(token.state,"play")
        token.destroy()
	},"Test Token Create")
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