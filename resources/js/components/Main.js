import axios from "axios";
import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import Login from "./Login";
import NearestBusStops from "./NearestBusStops";

function Main() {
    // Laravel passport config
    const clientId = 2;
    const clientSecret = 'H1qbLLIWgJ4O3Vf4BoSJfLmei6NA8umcAyzhwQ2h';
    // End of Laravel passport config

    let accessToken = localStorage.getItem('access_token');
    let expiry = localStorage.getItem('expiry');
    let remainLoggedIn = (accessToken && expiry > Date.now());

    const [isLoggedIn, setIsLoggedIn] = useState(remainLoggedIn);

    if (remainLoggedIn) {
        axios.defaults.headers.common = {'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}`}
    }

    return (
        <div className="container">
          <div className="row justify-content-center">
              <div className="col-md-8">
                  <div className="card">
                      { isLoggedIn ? <NearestBusStops />
                      : <Login clientId={clientId} clientSecret={clientSecret} isLoggedInHandler={setIsLoggedIn} /> }
                  </div>
              </div>
          </div>
        </div>
    );
}

if (document.getElementById('main')) {
    ReactDOM.render(<Main />, document.getElementById('main'));
}
