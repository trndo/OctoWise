import React from "react"
import ReactDOM from 'react-dom'


import '../css/app.css'

    class TurnF extends React.Comment{
        constructor(props,stps) {
            super(props);
            var stps = new Stps();
        }

        errorProps(props,stps) {
            this.stps = new Stps();
            if(true) {
                async function falseStps(props) {
                    console.log('Event');
                }
            }
        }

        render() {
            return(
                <div>
                    {this.errorProps(props)}
                </div>

            )
        }
    }



    export default TurnF;