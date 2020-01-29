using System.Collections;
using System.Collections.Generic;
using UnityEngine;


public class ControllerScript : MonoBehaviour {

    private Animator myAnimator;
    private Rigidbody pBody;
    private bool isRunning;
    public float DirectionDampTime = .25f;
    public bool ApplyGravity = true;


    void Start()
    {
        myAnimator = GetComponent<Animator>();
    }

    void Update()
    {
        myAnimator.SetFloat("VSpeed", Input.GetAxis("Vertical"));
        myAnimator.SetFloat("HSpeed", Input.GetAxis("Horizontal"));
        AnimatorStateInfo stateInfo = myAnimator.GetCurrentAnimatorStateInfo(0);

    
        if (Input.GetKey(KeyCode.LeftShift))
        {
            myAnimator.SetBool("Run", true);
            myAnimator.SetFloat("VSpeed", 0.6f);
        }
        else
        {
            myAnimator.SetBool("Run", false);
        } 
    
        if (Input.GetButtonDown("Jump"))
        {
            myAnimator.SetBool("Jumping", true);
            Invoke("StopJumping", 0.1f);
        }

    



        if (Input.GetKey("q"))
        {
            transform.Rotate(Vector3.down * Time.deltaTime * 100.0f);
            if ((Input.GetAxis("Vertical") == 0f) && (Input.GetAxis("Horizontal") == 0))
            {
                myAnimator.SetBool("TurningLeft", true);
            }
        }
        else
        {
            myAnimator.SetBool("TurningLeft", false);
        }



        if (Input.GetKey("e"))
        {
            transform.Rotate(Vector3.up * Time.deltaTime * 100.0f); if ((Input.GetAxis("Vertical") == 0f) &&
           (Input.GetAxis("Horizontal") == 0))
            {
                myAnimator.SetBool("TurningRight", true);
            }
        }
        else
        {
            myAnimator.SetBool("TurningRight", false);
        }

        if (Input.GetKeyDown("1"))
        {
            if (myAnimator.GetInteger("CurrentAction") == 0)
            {
                myAnimator.SetInteger("CurrentAction", 1);
            }
            else if (myAnimator.GetInteger("CurrentAction") == 1)
            {
                myAnimator.SetInteger("CurrentAction", 0);
            }
        }
        if (Input.GetKeyDown("2"))
        {
            if (myAnimator.GetInteger("CurrentAction") == 0)
            {
                myAnimator.SetInteger("CurrentAction", 2);
            }
            else if (myAnimator.GetInteger("CurrentAction") == 2)
            {
                myAnimator.SetInteger("CurrentAction", 0);
            }
        }
        if (Input.GetKeyDown("3"))
        {
            myAnimator.SetLayerWeight(1, 1f);
            myAnimator.SetInteger("CurrentAction", 3);
        }

        if (Input.GetKeyUp("3"))
        {
            myAnimator.SetInteger("CurrentAction", 0);
        }
      

    }

    void StopJumping()
    {
        myAnimator.SetBool("Jumping", false);
    }
}
