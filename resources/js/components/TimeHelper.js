import React, { Component } from "react";
import ReactDOM from "react-dom";
import https from "https";

export default class TimeHelper extends Component {
    constructor(props) {
        super(props);

        this.state = {
            izabrani_kontinent: "Europe"
        };
    }

    loadTime(e) {
        e.preventDefault();
        https
            .get(
                `https://worldtimeapi.org/api/timezone/${this.state.izabrani_kontinent}/${this.state.izabrani_grad}`,
                resp => {
                    let data = "";

                    resp.on("data", chunk => {
                        data += chunk;
                    });

                    resp.on("end", () => {
                        const date = JSON.parse(data)
                            .datetime.split(".")[0]
                            .split("T");
                        const datum = date[0];
                        const vreme = date[1];

                        this.setState({
                            datum: datum,
                            vreme: vreme
                        });
                    });
                }
            )
            .on("error", err => {
                console.log("Error: " + err);
                alert(err);
            });
    }
    changeHandler(e) {
        this.setState({ [e.target.name]: e.target.value });
    }
    render() {
        return (
            <div className="container">
                <form onSubmit={this.loadTime.bind(this)}>
                    <div className="row">
                        <div className="col">
                            <select
                                className="form-control"
                                onChange={this.changeHandler.bind(this)}
                                name="izabrani_kontinent"
                            >
                                <option value="Europe">Evropa</option>
                                <option value="America">Amerika</option>
                                <option value="Africa">Afrika</option>
                                <option value="Asia">Azija</option>
                                <option value="Australia">Australija</option>
                                <option value="Pacific">Pacifik</option>
                            </select>
                        </div>

                        <div className="col">
                            <input
                                className="form-control"
                                onChange={this.changeHandler.bind(this)}
                                name="izabrani_grad"
                                placeholder="Grad"
                            ></input>
                        </div>

                        <div className="col">
                            <input
                                className="form-control"
                                type="text"
                                disabled={true}
                                value={this.state.vreme || "00:00:00"}
                            ></input>
                        </div>

                        <div className="col">
                            <input
                                id="btn-izracunaj"
                                className="btn  btn-block"
                                type="submit"
                                value="Izracunaj"
                            ></input>
                        </div>
                    </div>
                </form>
                <br></br>
            </div>
        );
    }
}

if (document.getElementById("timehelper")) {
    ReactDOM.render(<TimeHelper />, document.getElementById("timehelper"));
}
