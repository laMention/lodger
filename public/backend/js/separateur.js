function separer_nombre_2(nbr)
{
		var nombre = ''+nbr;
		var retour = '';
		var count=0;
		for(var i=nombre.length-1 ; i>=0 ; i--)
		{
			if(count!=0 && count % 2 == 0)
				retour = nombre[i]+' '+retour ;
			else
				retour = nombre[i]+retour ;
			count++;
		}
		// alert('nb : '+nbr+' => '+retour);

		return retour;
}
function separer_nombre_3(nbr)
{
		var nombre = ''+nbr;
		var retour = '';
		var count=0;
		for(var i=nombre.length-1 ; i>=0 ; i--)
		{
			if(count!=0 && count % 3 == 0)
				retour = nombre[i]+' '+retour ;
			else
				retour = nombre[i]+retour ;
			count++;
		}
		// alert('nb : '+nbr+' => '+retour);
		return retour;
}

function recup(nbr)
{
	var nbre = separer_nombre_2(nbr).split(' ')

	// alert('nb 0 :  => '+nbre[0]);

	return nbre[0]


}