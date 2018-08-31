import React from 'react';
import {Form, Upload, message, Icon, InputNumber, Row, Col, Tag, Input, Checkbox, Button   } from 'antd';
import {PostMap} from './PostMap';
const TextArea = Input.TextArea;

const CheckableTag = Tag.CheckableTag;
const tagsFromServer = ['#21DayChallenge', '#NeverGiveUp', '#RunHappy', '#MyRunningJourney','#BornToRun' ];

const FormItem = Form.Item;

function getBase64(img, callback) {
  const reader = new FileReader();
  reader.addEventListener('load', () => callback(reader.result));
  reader.readAsDataURL(img);
}

function beforeUpload(file) {
  const isJPG = file.type === 'image/jpeg';
  const isPNG = file.type === 'image/png';
  
  if (!isJPG && !isPNG) {
    message.error('You can only upload JPG/PNG file!');
  }
  const isLt2M = file.size / 1024 / 1024 < 2;
  if (!isLt2M) {
    message.error('Image must smaller than 2MB!');
  }
  return isJPG || isPNG && isLt2M;
}

class FeedForm extends React.Component{
  state = {
    selectedTags: [],
    loading: false,
    stravaClick: false,
    runTime: "",
    runDistance: "",
    startLatLng : null,
    runName: ""
  };

  getLatestRace = async () => {
    this.setState({
      stravaClick : true
    })
    const activities = await axios.get('https://www.strava.com/api/v3/athlete/activities',{
      params : {
        access_token : window.token,
        per_page : 1
      }
    })
  
    activities.data.map((data, index) => {
  
      let date = new Date(null);
      date.setSeconds(data.moving_time);
      let time = date.toISOString().substr(11, 8);
      console.log(data);
      this.setState({
        runDistance : data.distance / 1000,
        runTime : time,
        startLatLng: data.start_latlng,
        polylineSummary: data.map.summary_polyline,
        runName: data.name
      })
    })
  }

  handleTagChanges(tag, checked) {
    const { selectedTags } = this.state;
    const nextSelectedTags = checked
      ? [...selectedTags, tag]
      : selectedTags.filter(t => t !== tag);
      console.log(nextSelectedTags)
    this.setState({ selectedTags: nextSelectedTags });
  }

  handleChange = (info) => {
    if (info.file.status === 'uploading') {
      this.setState({ loading: true });
      return;
    }
    if (info.file.status === 'done') {
      // Get this url from response in real world.
      getBase64(info.file.originFileObj, imageUrl => this.setState({
        imageUrl,
        loading: false,
      }));
    }
  }

  renderMap = () => {
    return(
      <PostMap 
        lat={this.state.startLatLng[0]} 
        lng={this.state.startLatLng[1]} 
        zoom={18} 
        polylineSummary={this.state.polylineSummary}
        isMarkerShown={false} 
        googleMapURL="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=geometry,drawing,places&key=AIzaSyDSiQbulj2nBDKlMN5XQDUecixe3Eq5ZyM "
        loadingElement={<div style={{ height: `100%` }} />}
        containerElement={<div style={{ height: `400px` }} />}
        mapElement={<div style={{ height: `100%` }} />}/>
    )
  }

  render(){
    const { selectedTags } = this.state;
    const { getFieldDecorator } = this.props.form;

    const formItemLayout = {
      labelCol: {
        xs: { span: 24 },
        sm: { span: 8 },
      },
      wrapperCol: {
        xs: { span: 24 },
        sm: { span: 16 },
      },
    };

    const uploadButton = (
      <div>
        <Icon type={this.state.loading ? 'loading' : 'plus'} />
        <div className="ant-upload-text">Upload</div>
      </div>
    );

    const imageUrl = this.state.imageUrl;
    let postMap

    if(this.state.stravaClick){
      if(this.state.startLatLng != null){
        postMap = this.renderMap()
      }
        
    } else {
      postMap = ""
    }

    return(   
          <Form>
          {this.state.stravaClick ? "" : <Button onClick={this.getLatestRace}>Get Latest Race from Strava</Button>}
          {postMap}
          
          <FormItem
            {...formItemLayout}
          >
            {getFieldDecorator('upload', {
            })(
              <Upload 
                name="logo"
                action="/upload.do"
                listType="picture-card"
                showUploadList={false}
                beforeUpload={beforeUpload}
                onChange={this.handleChange}
                >
                {imageUrl ? <img src={imageUrl} width="200px" alt="feedimg" /> : uploadButton}
              </Upload>
            )}
          </FormItem>
          <FormItem
            wrapperCol = {{
              xs: { span: 24 },
              sm: { span: 24 },
            }}
            labelCol = {{
              xs: { span: 24 },
              sm: { span: 24 },
            }}
            label={(
              <span>
                Title&nbsp;
              </span>
            )}
          >
            {getFieldDecorator('journey-tag', {
              initialValue : this.state.runName != "" ? this.state.runName : ""
            })(
              <Input disabled={this.state.stravaClick ? true : false}/>
            )}
          </FormItem>
          <Row>
          <Col span={5}>
            <FormItem
              wrapperCol = {{
                xs: { span: 24 },
                sm: { span: 24 },
              }}
              labelCol = {{
                xs: { span: 24 },
                sm: { span: 24 },
              }}
              label="Hour"
            >
            {getFieldDecorator('hour', {
              rules: [{ required: true, message: 'Hour Required!' },{type: "number" , message: "Must be number"}],
              initialValue: this.state.runTime != "" ? this.state.runTime.substr(0, 2) : ""
            })(
              <InputNumber disabled={this.state.stravaClick ? true : false}/>
            )}
            </FormItem>
          </Col>
          <Col span={5}>
            <FormItem
              wrapperCol = {{
                xs: { span: 24 },
                sm: { span: 24 },
              }}
              labelCol = {{
                xs: { span: 24 },
                sm: { span: 24 },
              }}
              label="Min"
            >
            {getFieldDecorator('minutes', {
              rules: [{ required: true, message: 'Minutes Required!' },{type: "number" , message: "Must be number"}],
              initialValue: this.state.runTime != "" ? this.state.runTime.substr(3, 2) : ""
            })(
              <InputNumber disabled={this.state.stravaClick ? true : false}/>
            )}
            </FormItem>
          </Col>
          <Col span={5}>
            <FormItem
              wrapperCol = {{
                xs: { span: 24 },
                sm: { span: 24 },
              }}
              labelCol = {{
                xs: { span: 24 },
                sm: { span: 24 },
              }}
              label="Sec"
            >
            {getFieldDecorator('sec', {
              rules: [{ required: true, message: 'Sec Required!' },{type: "number" , message: "Must be number"}],
              initialValue: this.state.runTime != "" ? this.state.runTime.substr(6, 2) : ""
            })(
              <InputNumber disabled={this.state.stravaClick ? true : false}/>
            )}
            </FormItem>
          </Col>
          </Row>
          <FormItem
              wrapperCol = {{
                xs: { span: 24 },
                sm: { span: 24 },
              }}
              labelCol = {{
                xs: { span: 24 },
                sm: { span: 24 },
              }}
              label="Distance complete in km"
            >
            {getFieldDecorator('distance', {
              rules: [{ required: true, message: 'Distance Required!', whitespace: true },{type: "number" , message: "Must be number"}],
              initialValue : this.state.runDistance != "" ? this.state.runDistance.toFixed(2) : ""
            })(
              <InputNumber disabled={this.state.stravaClick ? true : false}/>
            )}
          </FormItem>
          <FormItem
            wrapperCol = {{
              xs: { span: 24 },
              sm: { span: 24 },
            }}
            labelCol = {{
              xs: { span: 24 },
              sm: { span: 24 },
            }}
            label={(
              <span>
                Journey Entry&nbsp;
              </span>
            )}
          >
            {getFieldDecorator('journey-tag', {
              initialValue : this.state.selectedTags.join()
            })(
              <TextArea />
            )}
          </FormItem>
          Tags: <br />
          {tagsFromServer.map(tag => (
            <CheckableTag
              key={tag}
              checked={selectedTags.indexOf(tag) > -1}
              onChange={checked => this.handleTagChanges(tag, checked)}
            >
              {tag}
            </CheckableTag>
          ))}
          <FormItem {...formItemLayout}>
            {getFieldDecorator('submission', {
              valuePropName: 'checked',
            })(
              <Checkbox>I declare my submission is truthful</Checkbox>
            )}
          </FormItem>
        </Form>
    )
  }
}

const AddFeedForm = Form.create()(FeedForm);

export default AddFeedForm;