import React, { PureComponent, Fragment } from 'react';
import ReactDOM from 'react-dom';
import { Card, Steps } from 'antd';
import styles from './style.less';

const { Step } = Steps;

class RegisterRaceFormEn extends PureComponent {
  getCurrentStep() {
    const { location } = this.props;
    const { pathname } = location;
    const pathList = pathname.split('/');
    switch (pathList[pathList.length - 1]) {
      case 'info':
        return 0;
      case 'confirm':
        return 1;
      case 'result':
        return 2;
      default:
        return 0;
    }
  }

  render() {
    const { location, children } = this.props;
    return (

        <Card bordered={false}>
          <Fragment>
            <Steps current={this.getCurrentStep()} className={styles.steps}>
              <Step title="填写转账信息" />
              <Step title="确认转账信息" />
              <Step title="完成" />
            </Steps>
            {children}
          </Fragment>
        </Card>

    );
  }
}

export default RegisterRaceFormEn

if(document.getElementById('registerraceform-en')){
    ReactDOM.render(<RegisterRaceFormEn />, document.getElementById('registerraceform-en'))
}
