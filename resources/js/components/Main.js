import axios from "axios";
import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import Login from "./Login";
import NearestBusStops from "./NearestBusStops";

function Main({clientId, clientSecret}) {
    let accessToken = localStorage.getItem('access_token');
    let expiry = localStorage.getItem('expiry');
    let remainLoggedIn = (accessToken && expiry > Date.now());

    const [isLoggedIn, setIsLoggedIn] = useState(remainLoggedIn);

    if (remainLoggedIn) {
        axios.defaults.headers.common = {'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}`}
    }

    function logout() {
        localStorage.clear();
        axios.defaults.headers.common = {'Accept': 'application/json'}

        setIsLoggedIn(false);
    }

    return (
        <div className="container">
          <div className="row justify-content-center">
              <div className="col-md-8">
                  <div className="card">
                      { isLoggedIn ? <NearestBusStops logoutHandler={logout} />
                      : <Login clientId={clientId} clientSecret={clientSecret} isLoggedInHandler={setIsLoggedIn} /> }
                  </div>
              </div>
          </div>
        </div>
    );
}

if (document.getElementById('main')) {
    ReactDOM.render(<Main clientId={process.env.MIX_CLIENT_ID} clientSecret={process.env.MIX_CLIENT_SECRET} />, document.getElementById('main'));
}
