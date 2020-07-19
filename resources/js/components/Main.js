import React from 'react';
import ReactDOM from 'react-dom';

function Main() {
    return (
        <div className="container">
          <div className="row justify-content-center">
              <div className="col-md-8">
                  <div className="card">
                      <div className="card-header">Example Component</div>

                      <div className="card-body">I'm an example test component!</div>
                  </div>
              </div>
          </div>
        </div>
    );
}

if (document.getElementById('main')) {
    ReactDOM.render(<Main />, document.getElementById('main'));
}
