function main(options) {

    var map = L.map(options.map, {
        zoomControl: false,
        center: [options.x, options.y],
        zoom: options.zoom
    });

    // add a nice baselayer from mapbox
    L.tileLayer('http://{s}.tiles.mapbox.com/v3/d4weed.map-da1z3qw8/{z}/{x}/{y}.png', {
        attribution: 'MapBox'
    }).addTo(map);

    cartodb.createLayer(map, 'http://' + options.user + '.cartodb.com/api/v1/viz/' + options.table + '/viz.json', {
        query: 'select * from ' + options.table + ' where ' + options.filter,
    }).on('done', function(layer) {
        console.log('select * from ' + options.table + ' where ' + options.filter);

        map.on('layeradd', function() {
            $('#' + options.map).show();
        });
        map.addLayer(layer);

        layer.on('featureOver', function(e, pos, latlng, data) {});

        layer.on('error', function(err) {
            cartodb.log.log('error: ' + err);
        });

    }).on('error', function() {
        cartodb.log.log("some error occurred");
    });

}