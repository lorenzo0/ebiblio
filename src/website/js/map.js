import {Map, View} from 'openStreetMap/node_modules/ol';
import TileLayer from 'openStreetMap/node_modules/ol/layer/Tile';
import XYZ from 'openStreetMap/node_modules/ol/source/XYZ';

new Map({
  target: 'map',
  layers: [
    new TileLayer({
      source: new XYZ({
        url: 'https://{a-c}.tile.openstreetmap.org/{z}/{x}/{y}.png'
      })
    })
  ],
  view: new View({
    center: [0, 0],
    zoom: 2
  })
});