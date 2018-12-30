from flask.ext.googlemaps import GoogleMaps as googlemaps
from datetime import datetime


def finddist(source, destination):
    gmaps = googlemaps.Client(key='AIzaSyCWYpeH2L3t_4Dk3U0RTte8TdaVtFGRoac')


    now = datetime.now()
    directions_result = gmaps.directions(source, destination, mode="driving", departure_time=now)
    for map1 in directions_result:
        overall_stats = map1['legs']
        for dimensions in overall_stats:
            distance = dimensions['distance']
            return [distance['text']]


def findtime(source, destination):
    gmaps = googlemaps.Client(key='XXX')
    now = datetime.now()
    directions_result = gmaps.directions(source, destination, mode="driving", departure_time=now)
    for map1 in directions_result:
        overall_stats = map1['legs']
        for dimensions in overall_stats:
            duration = dimensions['duration']
            return [duration['text']]




