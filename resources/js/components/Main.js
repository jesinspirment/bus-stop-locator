import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import Login from "./Login";
import NearestBusStops from "./NearestBusStops";
import axios from 'axios';

function Main() {


    // Laravel passport config
    const clientId = 2;
    const clientSecret = 'H1qbLLIWgJ4O3Vf4BoSJfLmei6NA8umcAyzhwQ2h';
    // End of Laravel passport config

    const [isLoggedIn, setIsLoggedIn] = useState(false);

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
