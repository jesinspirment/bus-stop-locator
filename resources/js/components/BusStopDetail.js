import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

export default function BusStopDetail() {
    // Hard code user's current location
    const userLatitude = 1.383194;
    const userLongitude = 103.850051;

    const [busStops, setBusStops] = useState([]);
    const [buses, setBuses] = useState([]);

    useEffect(() => {
      axios.get(`/api/bus-stop/nearest?lat=${userLatitude}&lon=${userLongitude}`)
          .then(response => {
              if (200 === response.status) {
                  setBusStops(response.data.data);
              }
          });
    }, []);

    function showModal(busStopId) {
      axios.get(`/api/bus-facility-schedule/next-bus-timings/${busStopId}`)
        .then(response => {
          if (200 === response.status) {
            setBuses(response.data.data);
          }
        });

      $('#exampleModal').modal('show');
    }

    return (
        <React.Fragment>
          <h2>Bus stops nearest to your current location</h2>
          <span>Click bus stop to view bus timing</span>

          <table id="bus-stops" className="table table-hover table-striped">
            <thead>
              <tr>
                <th>Reference Code</th>
                <th>Location Name</th>
                <th>Buses</th>
                <th>Distance</th>
              </tr>
            </thead>

            <tbody>
              { busStops.map((item, i) => {
                return (
                  <tr key={item.id} onClick={() => showModal(item.id)}>
                    <td>{item.reference_code}</td>
                    <td>{item.location_name}</td>
                    <td>
                      {item.buses.map((busNumber, j) =>
                        <span key={busNumber} className="bus-number badge badge-pill badge-primary">{busNumber}</span>
                      )}
                    </td>
                    <td>{item.distance} metres away</td>
                  </tr>
                );
              }) }
            </tbody>
          </table>

          {/* Modal to show bus timings when a bus stop is clicked */}
          <div className="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div className="modal-dialog" role="document">
              <div className="modal-content">
                <div className="modal-header">
                  <h5 className="modal-title" id="exampleModalLabel">Bus Arrival Info</h5>
                  <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div className="modal-body">
                  <table className="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Bus Service Number</th>
                        <th>Next arrival time</th>
                        <th>Arriving In (Minutes)</th>
                      </tr>
                    </thead>

                    <tbody>
                    { buses.map((item, i) => {
                      return (
                        <tr key={item.bus_number}>
                          <td>{item.bus_number}</td>
                          <td>{item.next_arrival_time}</td>
                          <td>{item.arriving_in_minutes}</td>
                        </tr>
                      );
                    })}
                    </tbody>
                  </table>
                </div>
                <div className="modal-footer">
                  <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </React.Fragment>
    );
}