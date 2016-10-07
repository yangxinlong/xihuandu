function arc_view_count(aid){
	aid = parseInt(aid);
	if(isNaN(aid) || aid == 0) return;
	var x = new Ajax('XML');
	x.get(cmsUrl + 'view_count.php?aid=' + aid, function(s){
		if(s == 'error') return;
		var vcdatas,vcitems;
		vcdatas = s.split('-');
		for(k in vcdatas){
			vcitems = vcdatas[k].split('#');
			try{
				$('cms_' + vcitems[0]).innerHTML = vcitems[1];
			}catch (e){
				continue;
			}
		}
	});
}