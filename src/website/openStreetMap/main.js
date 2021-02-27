import Map from 'ol/Map';
import OSM from 'ol/source/OSM';
import TileLayer from 'ol/layer/Tile';
import {transform} from 'ol/proj.js';
import View from 'ol/View';

var map = new Map({
  layers: [
    new TileLayer({
      source: new OSM(),
    }) ],
  target: 'map',
  view: new View({
    center: transform([11.34,44.49], 'EPSG:4326', 'EPSG:3857'),
    zoom: 13,
  }),
});
