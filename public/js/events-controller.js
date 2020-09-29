const app = angular.module('events', []);
app.controller('eventsCtrl', ($scope, $http) => {
  $scope.resetFilters = () => {
    $scope.filterEvent = '';
    $scope.filterLocation = '';
  };
  $http
    .get('../resources/get-events.php')
    .then((res) => {
      $scope.events = res.data;
      $scope.events.forEach((event) => {
        event.event_datetime = new Date(
          Date.parse(event.event_datetime.replace(/-/g, '/'))
        );
      });
      console.log($scope.events);
      const venues = [];
      $scope.events.forEach((event) => {
        const venue = {
          name: event.venue_name,
          lat: event.venue_lat,
          lng: event.venue_lng,
          address: event.venue_address,
        };
        venues.push(venue);
      });

      $scope.markers = [];
      $scope.gMap = null;
      const centerLat = venues[0].lat;
      const centerLng = venues[0].lng;

      const mapOptions = {
        zoom: 14,
        center: new google.maps.LatLng(centerLat, centerLng),
        styles: mapStyles,
      };

      $scope.gMap = new google.maps.Map(
        document.getElementById('myMap'),
        mapOptions
      );

      function createMarkers(venue) {
        // new marker
        const marker = new google.maps.Marker({
          map: $scope.gMap,
          position: new google.maps.LatLng(venue.lat, venue.lng),
          title: venue.name,
        });

        // marker info window
        const infoWindow = new google.maps.InfoWindow();
        marker.content = `<div class="text-black">${venue.address}</div>`;
        infoWindow.setContent(
          `<p class="font-semibold text-black">${venue.name}</p>${marker.content}`
        );
        infoWindow.open($scope.gMap, marker);

        // Add to markers array
        $scope.markers.push(marker);
      }

      venues.forEach((venue) => {
        createMarkers(venue);
      });
    })
    .catch((err) => {
      console.error(err);
    });
});

// Array of map styles - API key needed to view this mode
const mapStyles = [
  {
    elementType: 'geometry',
    stylers: [
      {
        color: '#1d2c4d',
      },
    ],
  },
  {
    elementType: 'labels.text.fill',
    stylers: [
      {
        color: '#8ec3b9',
      },
    ],
  },
  {
    elementType: 'labels.text.stroke',
    stylers: [
      {
        color: '#1a3646',
      },
    ],
  },
  {
    featureType: 'administrative.country',
    elementType: 'geometry.stroke',
    stylers: [
      {
        color: '#4b6878',
      },
    ],
  },
  {
    featureType: 'administrative.land_parcel',
    elementType: 'labels.text.fill',
    stylers: [
      {
        color: '#64779e',
      },
    ],
  },
  {
    featureType: 'administrative.province',
    elementType: 'geometry.stroke',
    stylers: [
      {
        color: '#4b6878',
      },
    ],
  },
  {
    featureType: 'landscape.man_made',
    elementType: 'geometry.stroke',
    stylers: [
      {
        color: '#334e87',
      },
    ],
  },
  {
    featureType: 'landscape.natural',
    elementType: 'geometry',
    stylers: [
      {
        color: '#023e58',
      },
    ],
  },
  {
    featureType: 'poi',
    elementType: 'geometry',
    stylers: [
      {
        color: '#283d6a',
      },
    ],
  },
  {
    featureType: 'poi',
    elementType: 'labels.text.fill',
    stylers: [
      {
        color: '#6f9ba5',
      },
    ],
  },
  {
    featureType: 'poi',
    elementType: 'labels.text.stroke',
    stylers: [
      {
        color: '#1d2c4d',
      },
    ],
  },
  {
    featureType: 'poi.park',
    elementType: 'geometry.fill',
    stylers: [
      {
        color: '#023e58',
      },
    ],
  },
  {
    featureType: 'poi.park',
    elementType: 'labels.text.fill',
    stylers: [
      {
        color: '#3C7680',
      },
    ],
  },
  {
    featureType: 'road',
    elementType: 'geometry',
    stylers: [
      {
        color: '#304a7d',
      },
    ],
  },
  {
    featureType: 'road',
    elementType: 'labels.text.fill',
    stylers: [
      {
        color: '#98a5be',
      },
    ],
  },
  {
    featureType: 'road',
    elementType: 'labels.text.stroke',
    stylers: [
      {
        color: '#1d2c4d',
      },
    ],
  },
  {
    featureType: 'road.highway',
    elementType: 'geometry',
    stylers: [
      {
        color: '#2c6675',
      },
    ],
  },
  {
    featureType: 'road.highway',
    elementType: 'geometry.stroke',
    stylers: [
      {
        color: '#255763',
      },
    ],
  },
  {
    featureType: 'road.highway',
    elementType: 'labels.text.fill',
    stylers: [
      {
        color: '#b0d5ce',
      },
    ],
  },
  {
    featureType: 'road.highway',
    elementType: 'labels.text.stroke',
    stylers: [
      {
        color: '#023e58',
      },
    ],
  },
  {
    featureType: 'transit',
    elementType: 'labels.text.fill',
    stylers: [
      {
        color: '#98a5be',
      },
    ],
  },
  {
    featureType: 'transit',
    elementType: 'labels.text.stroke',
    stylers: [
      {
        color: '#1d2c4d',
      },
    ],
  },
  {
    featureType: 'transit.line',
    elementType: 'geometry.fill',
    stylers: [
      {
        color: '#283d6a',
      },
    ],
  },
  {
    featureType: 'transit.station',
    elementType: 'geometry',
    stylers: [
      {
        color: '#3a4762',
      },
    ],
  },
  {
    featureType: 'water',
    elementType: 'geometry',
    stylers: [
      {
        color: '#0e1626',
      },
    ],
  },
  {
    featureType: 'water',
    elementType: 'labels.text.fill',
    stylers: [
      {
        color: '#4e6d70',
      },
    ],
  },
];
