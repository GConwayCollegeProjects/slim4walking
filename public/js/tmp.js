$('.nav-tabs a').on('show.bs.tab', function(){
    alert('The new tab is about to be shown.');
});
$('.nav-tabs a').on('shown.bs.tab', function(){
    alert('The new tab is now fully shown.');
});

$('.nav-tabs a').on('hidden.bs.tab', function(){
    alert('The previous tab is now fully hidden.');
});