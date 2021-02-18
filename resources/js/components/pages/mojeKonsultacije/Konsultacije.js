import Axios from "axios";
import React, { Component } from "react";
import ReactDOM from "react-dom";
import Konsultacija from "./Konsultacija";

export default class Konsultacije extends Component {
    constructor(props) {
        super(props);

        this.state = {
            konsultacije: [],
            controls: ""
        };
        this.fetchCasovi();
    }

    fetchCasovi(
        pageUrl = "http://127.0.0.1:8000/api/konsultacija/get?page=1?"
    ) {
        Axios.get(pageUrl).then(res => {
            this.setState({ konsultacije: res.data.konsultacije.data });

            this.buildControls(
                res.data.konsultacije.prev_page_url,
                res.data.konsultacije.next_page_url
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
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Naziv</th>
                        <th style={{ width: "45%" }}>Opis</th>
                        <th>Prijave</th>
                        <th>Datum</th>
                        <th>Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    {this.state.konsultacije.map(k => {
                        return <Konsultacija konsultacija={k} />;
                    })}
                </tbody>
            </table>,
            this.state.controls
        ];
    }
}

if (document.getElementById("konsultacije")) {
    ReactDOM.render(<Konsultacije />, document.getElementById("konsultacije"));
}
