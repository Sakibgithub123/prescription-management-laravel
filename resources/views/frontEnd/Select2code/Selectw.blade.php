 <!-- @php
                                    $allComplaints = json_decode($prescriptions->complaints);
                                    foreach($complaints as $complaint) {
                                    if (!in_array($complaint->complaints, $allComplaints)) {
                                    $allComplaints[] = $complaint->complaints;
                                    }
                                    }
                                    @endphp
                                    @foreach($allComplaints as $complaint)
                                    
                                    <option value="{{ $complaint }}" @if(in_array($complaint, json_decode($prescriptions->complaints))) selected @endif>{{ $complaint }}</option>
                                    @endforeach
                                     -->
                                            <!-- <div class="col-sm-4">
                            <h3 class="text-center">Test</h3>
                            <div class="input-group">
                                <select class="form-select  tag2" name="tests[]" multiple="multiple" aria-label="Default select example">
                                    @foreach(json_decode($prescriptions->tests) as $member)
                                    <option value="{{$member}}" selected>{{$member}}</option>
                                    @endforeach
                                    @foreach($tests as $test)
                                    <option value="{{$test->test}}">{{$test->test}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> -->

                                     <!-- @php
                                    $allTests = json_decode($prescriptions->tests);
                                    foreach($tests as $test) {
                                    if (!in_array($test->test, $allTests)) {
                                    $allTests[] = $test->test;
                                    }
                                    }
                                    @endphp
                                    @foreach($allTests as $test)
                                    <option value="{{ $test }}" @if(in_array($test, json_decode($prescriptions->tests))) selected @endif>{{ $test }}</option>
                                    @endforeach -->

                                     <!-- @php
                                    $allInvestigations = json_decode($prescriptions->investigations);
                                    foreach($investigations as $investigation) {
                                    if (!in_array($investigation->investigation, $allInvestigations)) {
                                    $allInvestigations[] = $investigation->investigation;
                                    }
                                    }
                                    @endphp
                                    @foreach($allInvestigations as $investigation)
                                    <option value="{{ $investigation }}" @if(in_array($investigation, json_decode($prescriptions->investigations))) selected @endif>{{ $investigation }}</option>
                                    @endforeach
                                    -->
                                           <!-- <div class="col-sm-4">
                            <h3 class="text-center">Investigations</h3>
                            <div class="input-group text-center">
                                <select class="form-select  tag3" name="investigations[]" multiple="multiple" aria-label="Default select example">
                                    @foreach(json_decode($prescriptions->investigations) as $member)
                                    <option value="{{$member}}" selected>{{$member}}</option>
                                    @endforeach
                                    @foreach($investigations as $investigation)
                                    <option value="{{$investigation->investigation}}">{{$investigation->investigation}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> -->