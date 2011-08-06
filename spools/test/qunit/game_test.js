module("Model: Spools.Models.Game")

test("findAll", function(){
	stop(2000);
	Spools.Models.Game.findAll({}, function(games){
		start()
		ok(games)
        ok(games.length)
        ok(games[0].name)
        ok(games[0].description)
	});
	
})

test("create", function(){
	stop(2000);
	new Spools.Models.Game({name: "dry cleaning", description: "take to street corner"}).save(function(game){
		start();
		ok(game);
        ok(game.id);
        equals(game.name,"dry cleaning")
        game.destroy()
	})
})
test("update" , function(){
	stop();
	new Spools.Models.Game({name: "cook dinner", description: "chicken"}).
            save(function(game){
            	equals(game.description,"chicken");
        		game.update({description: "steak"},function(game){
        			start()
        			equals(game.description,"steak");
        			game.destroy();
        		})
            })

});
test("destroy", function(){
	stop(2000);
	new Spools.Models.Game({name: "mow grass", description: "use riding mower"}).
            destroy(function(game){
            	start();
            	ok( true ,"Destroy called" )
            })
})