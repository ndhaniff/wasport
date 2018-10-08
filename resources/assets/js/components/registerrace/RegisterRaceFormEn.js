import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Steps, Button, message } from 'antd';
import { Form, Input, DatePicker, Select } from 'antd';
import TextArea from 'antd/lib/input/TextArea';
import moment from 'moment';

const FormItem = Form.Item;
const Option = Select.Option;

const Step = Steps.Step;

const steps = [{
  title: 'Profile',
  content: 'First-content',
}, {
  title: 'Mailing Address',
  content: 'Second-content',
}, {
  title: 'Race',
  content: 'Last-content',
}, {
  title: 'Total',
  content: 'Last-content',
}];

class RegisterRaceFormEn extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      current: 0,
    };
  }

  state = {
    confirmDirty: false,
    firstname: '',
    lastname: '',
  }

  next() {
    const current = this.state.current + 1;
    this.setState({ current });
  }

  prev() {
    const current = this.state.current - 1;
    this.setState({ current });
  }

  handleProfile() {
    validateFields((err, values) => {
      if (!err) {

        

        const current = this.state.current + 1;
        this.setState({ current });
      }
    });
  }

  render() {
    const { current } = this.state;
    return (
      <div>
        <Steps current={current}>
          {steps.map(item => <Step key={item.title} title={item.title} />)}
        </Steps>
        <div className="steps-content">{steps[current].content}</div>
        <div className="steps-action">
          {
            current == 0
            && <Button type="primary" onClick={() => this.handleProfile()}>Next</Button>
          }
          /*{
            current < steps.length - 1
            && <Button type="primary" onClick={() => this.next()}>Next</Button>
          }*/
          {
            current === steps.length - 1
            && <Button type="primary" onClick={() => message.success('Redirecting to Payment')}>Make Payment</Button>
          }
          {
            current > 0
            && (
            <Button style={{ marginLeft: 8 }} onClick={() => this.prev()}>
              Previous
            </Button>
            )
          }
        </div>
      </div>
    );
  }
}

export default RegisterRaceFormEn

if(document.getElementById('registerraceform-en')){
    ReactDOM.render(<RegisterRaceFormEn />, document.getElementById('registerraceform-en'))
}
