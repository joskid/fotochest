function create_menu(basepath)
{
	var base = (basepath == 'null') ? '' : basepath;

	document.write(
		'<table cellpadding="0" cellspaceing="0" border="0" style="width:98%"><tr>' +
		'<td class="td" valign="top">' +

		'<ul>' +
		'<li><a href="'+base+'index.html">User Guide Home</a></li>' +	
		
		'</ul>' +	

		'<h3>Basic Info</h3>' +
		'<ul>' +
			'<li><a href="'+base+'general/requirements.html">Server Requirements</a></li>' +
			'<li><a href="'+base+'license.html">License Agreement</a></li>' +
			'<li><a href="'+base+'changelog.html">Change Log</a></li>' +
			'<li><a href="'+base+'credits.html">Credits</a></li>' +
		'</ul>' +	
		
		'<h3>Installation</h3>' +
		'<ul>' +
			'<li><a href="'+base+'overview/installation.html">Installation</a></li>' +
			
		'</ul>' +
		
			

				
		'</td><td class="td_sep" valign="top">' +

		'<h3>Front End Usage</h3>' +
		'<ul>' +
			'<li><a href="'+base+'general/albums.html">Albums</a></li>' +
			'<li><a href="'+base+'general/photos.html">Photos</a></li>' +
			'<li><a href="'+base+'general/slideshow.html">Slideshow</a></li>' +
			
			
		'</ul>' +
		
		'</td><td class="td_sep" valign="top">' +

				
		'<h3>Administrative Functions</h3>' +
		'<ul>' +
		'<li><a href="'+base+'admin/photomanagement.html">Photo Management</a></li>' +
                '<li><a href="'+base+'admin/albummanagement.html">Album Management</a></li>' +
                '<li><a href="'+base+'admin/usermanagement.html">User Management</a></li>' +
                '<li><a href="'+base+'admin/settings.html">Settings</a></li>' +
		
		'</ul>' +

		'</td><td class="td_sep" valign="top">' +

		'<h3>Developer Reference</h3>' +
		'<ul>' +
		'<li><a href="'+base+'developer/buildingthemes.html">Building Themes</a></li>' +
		
		'</ul>' +	


		'<h3>Additional Resources</h3>' +
		'<ul>' +
		'<li><a href="http://forums.fotochest.com">Community Forums</a></li>' +
		
		'</ul>' +	
		
		'</td></tr></table>');
}