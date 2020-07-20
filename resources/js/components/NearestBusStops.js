import axios from "axios";
import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

export default function NearestBusStops() {
    // Hard code user's current location
    const userLatitude = 1.383194;
    const userLongitude = 103.850051;

    // States for bus stops and buses
    const [busStops, setBusStops] = useState([]);
    const [buses, setBuses] = useState([]);

    // States for add bus form modal
    const [busStopId, setBusStopId] = useState(0);
    const [serviceNumber, setServiceNumber] = useState('');
    const [direction, setDirection] = useState('A');
    const [stopNumber, setStopNumber] = useState('');

    // Load nearest buses from API
    useEffect(() => {
      loadNearestBusStops();
    }, []);

    function loadNearestBusStops() {
      axios.get(`/api/bus-stop/nearest?lat=${userLatitude}&lon=${userLongitude}`)
        .then(response => {
          if (200 === response.status) {
            setBusStops(response.data.data);
          }
        });
    }

    function showTimingModal(busStopId) {
      axios.get(`/api/bus-facility-schedule/next-bus-timings/${busStopId}`)
        .then(response => {
          if (200 === response.status) {
            setBuses(response.data.data);
          }
        });

      $('#timingsModal').modal('show');
    }

    function showAddBusModal(busStopId) {
        setBusStopId(busStopId);
        $('#addBusModal').modal('show');
    }

    function handleAddBus() {
      // Simple validation first
      if (!validate()) {
        return;
      }

      // Now call Laravel Passport API to get access token
      const params = {
        service_number: serviceNumber,
        direction: direction,
        stop_number: stopNumber,
      };

      axios.post(`api/bus-stop/${busStopId}/add-bus`, params)
        .then(response => {
          if (200 === response.status) {
            // Reload bus stops
            loadNearestBusStops();
            $('#addBusModal').modal('hide');
          }
        })
        .catch(error => {
          let errors = [];

          console.log(error.response.data.errors);

          if (error.response.data.errors) {
            for (const field in error.response.data.errors) {
              for (let i = 0; i < error.response.data.errors[field].length; i++) {
                errors.push(error.response.data.errors[field][i]);
              }
            }

            alert(errors.join("\n"));
          }
        });
    }

    function validate() {
      if ('' == serviceNumber || '' == direction || '' == stopNumber) {
        alert('All fields are required. Please fill them in.');
        return false;
      }

      let errors = [];

      // Validate stop number
      if (serviceNumber != parseInt(serviceNumber)) {
        errors.push('Service number must be a number');
      } else if (serviceNumber < 1) {
        errors.push('Service number must be at least 1');
      } else if (serviceNumber > 999) {
        errors.push('Service number must be at most 999');
      }

      // Validate direction
      if (direction != 'A' && direction != 'B') {
        errors.push('Direction must be A or B');
      }

      // Validate stop number
      if (stopNumber != parseInt(stopNumber)) {
        errors.push('Stop number must be a number');
      } else if (stopNumber < 1) {
        errors.push('Stop number must be at least 1');
      }

      if (0 == errors.length) {
        return true;
      }

      alert(errors.join("\n"))
      return false;
    }

    return (
        <React.Fragment>
          <h2>Bus stops nearest to your current location</h2>
          <span>Click bus stop to view bus timing</span>

          <table id="bus-stops" className="table table-striped">
            <thead>
              <tr>
                <th>Reference Code</th>
                <th>Location Name</th>
                <th>Buses</th>
                <th>Distance</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
              { busStops.map((item, i) => {
                return (
                  <tr key={item.id}>
                    <td>{item.reference_code}</td>
                    <td>{item.location_name}</td>
                    <td>
                      {item.buses.map((busNumber, j) =>
                        <span key={busNumber} className="bus-number badge badge-pill badge-primary">{busNumber}</span>
                      )}
                    </td>
                    <td>{item.distance} metres away</td>
                    <td>
                      <button type="button" className="btn btn-dark" onClick={() => showTimingModal(item.id)}>Timings</button>
                      <br /><br />
                      <button type="button" className="btn btn-primary" onClick={() => showAddBusModal(item.id)}>Add Bus</button>
                    </td>
                  </tr>
                );
              }) }
            </tbody>
          </table>

          {/* Modal to show bus timings when a bus stop is clicked */}
          <div className="modal fade" id="timingsModal" role="dialog" aria-labelledby="timingModalLabel" aria-hidden="true">
            <div className="modal-dialog" role="document">
              <div className="modal-content">
                <div className="modal-header">
                  <h5 className="modal-title" id="timingModalLabel">Bus Arrival Info</h5>
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
                          <td>
                            <h3><span key={item.bus_number} className="bus-number badge badge-pill badge-primary">{item.bus_number}</span></h3>
                          </td>
                          <td>{item.next_arrival_time}</td>
                          <td>{item.arriving_in_minutes}</td>
                        </tr>
                      );
                    })}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          {/* Modal to add bus */}
          <div className="modal fade" id="addBusModal" role="dialog" aria-labelledby="addBusModalLabel" aria-hidden="true">
            <div className="modal-dialog" role="document">
              <div className="modal-content">
                <div className="modal-header">
                  <h5 className="modal-title" id="addBusModalLabel">Add Bus</h5>
                  <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div className="modal-body">
                  <form>
                    <div className="form-group">
                      <label htmlFor="service_number">Service number</label>
                      <input type="email" className="form-control" id="service_number" name="service_number" onChange={e => setServiceNumber(e.target.value.trim())} />
                    </div>

                    <div className="form-group">
                      <label htmlFor="direction">Direction</label>
                      <select className="form-control" name="direction" id="direction" onChange={e => setDirection(e.target.value.trim())}>
                        <option value="A">A</option>
                        <option value="B">B</option>
                      </select>

                      <div className="form-group">
                        <label htmlFor="service_number">Stop Number</label>
                        <input type="email" className="form-control" id="stop_number" name="stop_number" onChange={e => setStopNumber(e.target.value.trim())} />
                      </div>

                    </div>

                    <button type="button" className="btn btn-primary" onClick={handleAddBus}>Create</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </React.Fragment>
    );
}