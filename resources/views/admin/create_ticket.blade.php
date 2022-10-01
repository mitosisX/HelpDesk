@extends('admin.layout.app')

@section('title')
    <title>Create Ticket</title>
@endsection

@section('content')
    
        <!-- START ISSUES LIST-->
        <div class="column">
            <div class="column box">
              <nav class="navbar" role="navigation" aria-label="main navigation">
                <div class="navbar-start">
                  <h1 class="title is-size-3 has-text-info">Create ticket</h1>
                </div>
                <div class="navbar-end">
                  <div class="tags has-addons">
                    <span class="tag is-size-6 is-rounded">Ticket number</span>
                    <span class="tag is-info is-size-6 is-rounded">23</span>
                  </div>
                </div>
              </nav>
            </div>

            <section class="section" style="padding: 1.5rem;margin-top:-25px;">
              <div class="column box is-multiline">
                <form action="">
                  <div class="field">
                    <label class="label">Ticket name</label>
                    <div class="control">
                      <div class="column is-6 no-padding">
                        <input class="input is-rounded" type="text" placeholder="Give the ticket a title">
                      </div>
                    </div>
                  </div>

                  <div class="field">
                    <label class="label">Category</label>
                    <div class="control">
                      <div class="select is-rounded">
                        <select>
                          <option>Computer</option>
                          <option>Hardware</option>
                          <option>Network</option>
                        </select>
                      </div>
                    </div>
                    <!-- <p class="help is-success">This username is available</p> -->
                  </div>
                  
                  <div class="field">
                    <label class="label">Department</label>
                    <div class="control">
                      <div class="select is-rounded">
                        <select>
                          <option>Water</option>
                          <option>Options</option>
                          <option>Board</option>
                        </select>
                      </div>
                    </div>
                    <!-- <p class="help is-success">This username is available</p> -->
                  </div>
                  
                  <div class="field">
                    <label class="label">Reported by</label>
                    <div class="control">
                      <div class="column is-4 is-gapless no-padding">
                        <input class="input is-rounded" type="text" placeholder="Provide name">
                      </div>
                    </div>
                    <!-- <p class="help is-danger">This email is invalid</p> -->
                  </div>

                  <div class="field">
                    <label class="label">Their email</label>
                    <div class="control">
                      <div class="column is-4 no-padding">
                        <input class="input is-rounded" type="email" placeholder="Provide their email address">
                      </div>
                    </div>
                    <!-- <p class="help is-danger">This email is invalid</p> -->
                  </div>
                  
                  <div class="field">
                    <label class="label">Priority</label>
                    <div class="control">
                      <div class="select is-rounded">
                        <select>
                          <option>Low</option>
                          <option>Medium</option>
                          <option>High</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="field">
                    <label class="label" for="user_skills">Tags</label>
                    <div class="simple-tags"
                        id="container" 
                        data-simple-tags="CodeHim, HTML">
                    </div>
                    <p class="help has-text-info">
                      Comma-separated
                    </p>
                  </div>

                  <div class="field">
                    <label class="label">Due date</label>
                    <div class="control">
                      <div class="column is-2 no-padding">
                        <input type="date" id="duedate" data-close-on-select="false">
                      </div>
                    </div>
                    <p class="help is-link" id="datediff">-- days</p>
                  </div>
                  
                  <div class="field">
                    <label class="label">Description</label>
                    <div class="control">
                      <div class="column is-6 no-padding">
                        <textarea class="textarea" placeholder="Provide some brief description of the ticket"></textarea>
                      </div>
                    </div>
                  </div>
                  
                  <div class="field is-grouped">
                    <div class="control">
                      <button 
                        class="button is-info is-rounded" id="submit">Submit</button>
                    </div>
                    <div class="control">
                      <button 
                        class="button is-danger is-light is-rounded">Clear</button>
                    </div>
                  </div>
                </form>
              </div>
            </section>
        </div>
        <!-- END ISSUES LIST -->
@endsection