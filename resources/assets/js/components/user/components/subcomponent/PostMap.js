import React from 'react'
import {withScriptjs,Polyline, withGoogleMap, GoogleMap } from "react-google-maps"
import Polylines from '@mapbox/polyline';

export const PostMap = withScriptjs(withGoogleMap((props) => {
  
  let polyCoordsRaw = Polylines.decode(props.polylineSummary)
  let polyCoords = [
    {lat: polyCoordsRaw[0][0], lng:  polyCoordsRaw[0][1]},
    {lat: polyCoordsRaw[1][0], lng:  polyCoordsRaw[1][1]},
    {lat: polyCoordsRaw[2][0], lng:  polyCoordsRaw[2][1]},
  ]
  let bounds = new window.google.maps.LatLngBounds({lat: polyCoordsRaw[0][0], lng:  polyCoordsRaw[0][1]}, {lat: polyCoordsRaw[2][0], lng:  polyCoordsRaw[2][1]});

  return(
  <GoogleMap
    defaultZoom={props.zoom}
    defaultCenter={bounds.getCenter()}
    defaultOptions ={
      {draggable : false}
    }
  >
    {props.isMarkerShown && <Marker position={{ lat: -34.397, lng: 150.644 }} />}
    <Polyline path={polyCoords} geodesic={true} options={
      {strokeColor: 'red',
      strokeOpacity: 0.8,
      strokeWeight: 5,}} />
  </GoogleMap>
  )

} ))
