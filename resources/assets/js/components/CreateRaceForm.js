import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import ReactQuill from 'react-quill';
import Datetime from 'react-datetime';
import Dropzone from 'react-dropzone'

export default class CreateRaceForm extends Component {

    constructor(props){
        super(props)
        this.state = {
            about : '',
            awards : '',
            raceTitle : '',
            where : '',
            price : '',
            headerImg : [],
        }
        this.handleAboutChange = this.handleAboutChange.bind(this)
        this.handleRegistrationDateChange = this.handleRegistrationDateChange.bind(this)
        this.onDrop = this.onDrop.bind(this)
        this.removePreview = this.removePreview.bind(this)
        this.handleInputChange = this.handleInputChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
    }

    handleSubmit(e){
        e.preventDefault();
        console.log(this.state)
    }

    handleAboutChange(value){
        this.setState({ about: value })
    }

    handleInputChange({target: {value,name}}){
        this.state({
            [name] : value
        })
    }

    handleAwardsChange(e){
        //
    }

    handleRegistrationDateChange(moment) {
        this.setState({
            registrationDate
        });
      }

    onDrop(acceptedFiles, rejectedFiles) {
        let headerImg = this.state.headerImg

        headerImg.push(acceptedFiles)
        this.setState({headerImg})
    }

    removePreview(){
        this.setState({headerImg : []})
    }

    render() {
        if(this.state.headerImg.length != 0){
            var previewImg =  <div className="mb-2 text-center"><button onClick={this.removePreview} className="btn btn-danger float-right">X</button><br/><img height="300px" src={this.state.headerImg[0][0].preview} alt=""/></div>
        } else {
            var previewImg =  <img src="" alt=""/>
        }

        return (

            <div className="container p-5">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card">
                            <div className="card-header">Create Race</div>

                            <div className="card-body">
                                <form onSubmit={this.handleSubmit}>
                                    <div className="form-group">
                                    {previewImg}
                                    <Dropzone
                                        style={{
                                            "width": "100%",
                                            "border": "1px dashed",
                                            "padding": "5%",}}
                                        accept="image/jpeg, image/png"
                                        onDrop={this.onDrop}
                                        multiple={false}
                                    >
                                        <div className="text-center">
                                        <p>Try dropping some files here, or click to select files to upload.</p>
                                        <p>Only *.jpeg and *.png images will be accepted</p>
                                        </div>
                                    </Dropzone>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="racetitle">Race Title</label>
                                        <input onChange={this.handleInputChange} name="raceTitle" className="form-control" type="text" id="racetitle" />   
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="where">Where</label>
                                        <input className="form-control" onChange={this.handleInputChange} name="where" type="text" id="where" />
                                    </div>
                                    <div className="form-row">
                                    <div className="col-sm-6">
                                        <div className="form-group">
                                        <label htmlFor="price">Race Datetime</label>
                                        <div className="form-row">
                                            <div className="col-sm-5">
                                            <Datetime />
                                            </div>
                                            <div className="col-sm-1">
                                            to
                                            </div>
                                            <div className="col-sm-5">
                                            <Datetime />
                                            </div>
                                         </div>
                                        </div>
                                    </div>
                                    <div className="col-sm-6">
                                        <div className="form-group">
                                        <label htmlFor="price">Registration Deadline</label>
                                         <div className="form-row">
                                            <div className="col-sm-5">
                                            <Datetime />
                                            </div>
                                            <div className="col-sm-1">
                                            to
                                            </div>
                                            <div className="col-sm-5">
                                            <Datetime />
                                            </div>
                                         </div>
                                        </div>
                                    </div>
                                    <div className="col-sm-4">
                                        <div className="form-group">
                                                <label htmlFor="price">Price</label>
                                                <input onChange={this.handleInputChange} name="price" className="form-control" type="text" id="price" />
                                            </div>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <div>
                                        <label htmlFor="about">About</label>
                                        <ReactQuill style={{'height':'150px'}} theme="snow"  value={this.state.about} onChange={this.handleAboutChange} />
                                        </div>
                                    </div><br/><br/>
                                    <div className="form-group">
                                        <div>
                                        <label htmlFor="about">Awards</label>
                                        <ReactQuill style={{'height':'150px'}} theme="snow"  value={this.state.awards} onChange={this.handleAwardsChange} />
                                        </div>
                                    </div>
                                    <br/><br/>
                                    <button className="btn btn-primary" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('createraceform')) {
    ReactDOM.render(<CreateRaceForm />, document.getElementById('createraceform'));
}
