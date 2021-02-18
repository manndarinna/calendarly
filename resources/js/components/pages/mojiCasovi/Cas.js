import React, { Component } from "react";
import ReactDOM from "react-dom";

export default class Cas extends Component {
    constructor(props) {
        super(props);

        this.state = {
            cas: this.props.cas
        };
    }

    render() {
        return (
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    {" "}
                    <a href={"http://127.0.0.1:8000/cas/" + this.state.cas.id}>
                        Prikazi detaljno
                    </a>{" "}
                </td>
            </tr>
        );
    }
}

if (document.getElementById("cas")) {
    ReactDOM.render(<Cas />, document.getElementById("cas"));
}
