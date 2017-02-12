<?php 
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;
    
    
    public function testList()
    {
        
        $this->get('/api/user')
             ->seeJsonStructure([
                 '*' => [
                     'id', 'name', 'email', 'Image'
                 ]
             ])
             ->assertResponseOk();
             
        
             
        
    }
    
    public function testShowUser(){
        
        $user = factory(App\User::class)->create();
        
        $this->get('/api/user/'.$user->id)
             ->seeJsonStructure([
                 'id', 'name', 'email', 'Image'
             ])->assertResponseOk();
             
        
        $this->get('/api/user/1234567890')->assertResponseStatus(404);  
    }
    
    public function testCreateUser(){
        
        $user = factory(App\User::class)->create();
        
        $this->post('/api/user',[
            'name'=>$user->name,
            'email'=>'jairosolarte@ingenieros943.com'
            ])
            ->assertResponseStatus(200);
            
        $this->post('/api/user',[
            'name'=>$user->name,
            'email'=>''
            ])
            ->assertResponseStatus(500);    
        
        
    }
    
    public function testUpdateUser(){
        
        $user = factory(App\User::class)->create();
        
        $this->put('/api/user/'.$user->id,[
            'name'=>$user->name,
            'email'=>$user->email
            ])
            ->assertResponseStatus(200);
            
        $this->put('/api/user/'.$user->id,[
            'name'=>$user->name,
            'email'=>''
            ])
            ->assertResponseStatus(500);
            
        $this->put('/api/user/12345677',[
            'name'=>$user->name,
            'email'=>''
            ])
            ->assertResponseStatus(404);    
    }
    
    public function testDeleteUser(){
        $user = factory(App\User::class)->create();
        
        $this->delete('/api/user/'.$user->id)->assertResponseStatus(200);
        
        $this->delete('/api/user/12345678')->assertResponseStatus(404);
    }
    
    
}

?>