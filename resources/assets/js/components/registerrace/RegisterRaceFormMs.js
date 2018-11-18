import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import { Card, Steps } from 'antd';
import StepZilla from 'react-stepzilla'
import Step1 from './steps/Step1Ms'
import Step2 from './steps/Step2Ms'
import Step3 from './steps/Step3Ms'
import Step4 from './steps/Step4Ms'

class RegisterRaceFormMs extends Component {
  constructor(props) {
    super(props);
    this.state = {};

    this.sampleStore = {
      uid : window.user.id,
      firstname: window.user.firstname,
      lastname: window.user.lastname,
      phone: window.user.phone,
      gender: window.user.gender,
      birthday: window.user.birthday,
      add_fl: window.user.add_fl,
      add_sl: window.user.add_sl,
      city: window.user.city,
      state: window.user.state,
      postal: window.user.postal,
      savedToCloud: false,
      rid: window.race.rid,
      title_ms: window.race.title_ms,
      price: window.race.price,
      category: window.race.category,
      race_category: '',
      engrave: window.race.engrave,
      engrave_status: window.race.engrave_status,
      engrave_name: '',
      addons: window.addons,
      addon_1: '',
      addon_2: '',
      addon_3: '',
      addon_4: '',
      addon_5: '',
      addons_selected: [],
    };
  }

  componentDidMount() {}

  componentWillUnmount() {}

  getStore() {
    return this.sampleStore;
  }

  updateStore(update) {
    this.sampleStore = {
      ...this.sampleStore,
      ...update,
    }
  }

  render() {
    const steps =
    [
      {name: 'Profil', component: <Step1 getStore={() => (this.getStore())} updateStore={(u) => {this.updateStore(u)}} />},
      {name: 'Alamat', component: <Step2 getStore={() => (this.getStore())} updateStore={(u) => {this.updateStore(u)}} />},
      {name: 'Acara', component: <Step3 getStore={() => (this.getStore())} updateStore={(u) => {this.updateStore(u)}} />},
      {name: 'Sahkan', component: <Step4 getStore={() => (this.getStore())} updateStore={(u) => {this.updateStore(u)}} />},
    ]

    return (
      <div className='example'>
        <div className='step-progress'>
          <StepZilla
            stepsNavigation={false}
            steps={steps}
            preventEnterSubmission={true}
            nextTextOnFinalActionStep={"Membuat Bayaran"}
            hocValidationAppliedTo={[3]}
            //startAtStep={window.sessionStorage.getItem('step') ? parseFloat(window.sessionStorage.getItem('step')) : 0}
            startAtStep={0}
            onStepChange={(step) => window.sessionStorage.setItem('step', step)}
           />
        </div>
      </div>
    )
  }
}

export default RegisterRaceFormMs

if(document.getElementById('registerraceform-ms')){
    ReactDOM.render(<RegisterRaceFormMs />, document.getElementById('registerraceform-ms'))
}
