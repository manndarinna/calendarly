import Axios from "axios";
import React, { Component } from "react";
import ReactDOM from "react-dom";
import Cas from "./Cas";
export default class Casovi extends Component {
    constructor(props) {
        super(props);

        this.state = {
            casovi: [],
            controls: ""
        };
        this.fetchCasovi();
    }

    fetchCasovi(
        pageUrl = "http://127.0.0.1:8000/api/privatan-cas/get?page=1?"
    ) {
        Axios.get(pageUrl).then(res => {
            this.setState({ casovi: res.data.casovi.data });

            this.buildControls(
                res.data.casovi.prev_page_url,
                res.data.casovi.next_page_url
            );
        });
    }

    buildControls(prevBtnUrl = null, nextBtnUrl = null) {
        this.setState({
            controls: (
                <div className="d-flex justify-content-center">
                    <button
                        className="btn btn-primary"
                        disabled={prevBtnUrl ? false : true}
                        onClick={() => this.fetchCasovi(prevBtnUrl)}
                    >
                        Prethodna
                    </button>
                    <button
                        className="btn btn-primary"
                        disabled={nextBtnUrl ? false : true}
                        onClick={() => this.fetchCasovi(nextBtnUrl)}
                    >
                        Sledeca
                    </button>
                </div>
            )
        });
    }

    render() {
        return [
            <table className="table ">
                <thead className="thead-dark">
                    <tr>
                        <th>Naziv</th>
                        <th>Datum</th>
                        <th>Trajanje</th>
                        <th>Rezervisao</th>
                        <th>Akcija</th>
                    </tr>
                </thead>
                <tbody>
                    {this.state.casovi.map(cas => {
                        return <Cas key={cas.id} cas={cas} />;
                    })}
                </tbody>
            </table>,
            this.state.controls
        ];
    }
}

if (document.getElementById("casovi")) {
    ReactDOM.render(<Casovi />, document.getElementById("casovi"));
}
